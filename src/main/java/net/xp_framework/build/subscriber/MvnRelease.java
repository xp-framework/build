package net.xp_framework.build.subscriber;

import java.io.File;
import java.io.Reader;
import java.io.FileReader;
import java.io.LineNumberReader;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.util.Hashtable;

import com.rabbitmq.client.ConnectionFactory;
import com.rabbitmq.client.Connection;
import com.rabbitmq.client.Channel;
import com.rabbitmq.client.QueueingConsumer;

/**
 * Builds maven releases
 */
public class MvnRelease {

    /**
     * Displays usage on standard output and returns exitcode
     */
    protected int displayUsage() {
        System.out.println("Usage:");
        System.out.println("java " + MvnRelease.class.getName() + " [-c config] [-t timeout]");
        return 1;
    }

    /**
     * Parses configuration
     *
     * @param  file                  [description]
     * @return                       [description]
     * @throws FileNotFoundException [description]
     */
    protected Hashtable<String, Hashtable<String, String>> configurationFile(File file) throws IOException {
        if (!file.exists()) {
            throw new FileNotFoundException("*** Cannot find configuration " + file);
        }

        LineNumberReader reader = new LineNumberReader(new FileReader(file));
        String line;
        Hashtable<String, Hashtable<String, String>> configuration = new Hashtable<String, Hashtable<String, String>>();
        Hashtable<String, String> section = null;
        while (null != (line = reader.readLine())) {
            line = line.trim();
            if ("".equals(line) || line.startsWith(";")) {
                // Ignore
            } else if (line.startsWith("[")) {
                section = new Hashtable<String, String>();
                configuration.put(line.substring(1, line.length() - 1), section);
            } else if (section != null) {
                String[] value = line.split("\\s?=\\s?", 2);
                section.put(value[0], value[1].startsWith("\"")
                    ? value[1].substring(1, value[1].length() - 1)
                    : value[1]
                );
            }
        }
        return configuration;
    }

    public int run(String[] args) throws Throwable {

        // Parse arguments
        if (0 == args.length) return this.displayUsage();
        String config = "etc";
        for (int i= 0; i < args.length; i++) {
            if ("-c".equals(args[i])) {
                config = args[++i];
            } else if ("-t".equals(args[i])) {
                // TBD: Implement
            } else if ("-?".equals(args[i])) {
                return this.displayUsage();
            }
        }

        // Parse config
        Hashtable<String, Hashtable<String, String>> configuration = configurationFile(new File(config, "mq.ini"));

        // Connect
        ConnectionFactory factory = new ConnectionFactory();
        factory.setHost(configuration.get("endpoint").get("host"));
        factory.setUsername(configuration.get("endpoint").get("user"));
        factory.setPassword(configuration.get("endpoint").get("pass"));
        Connection connection = factory.newConnection();
        Channel channel = connection.createChannel();
        channel.basicQos(1);

        // Parse
        String origin = configuration.get("queue").get("build.mvn");
        String queue = null;
        if (origin.startsWith("/queue/")) {
            queue = channel.queueDeclarePassive(origin.substring("/queue/".length())).getQueue();
        } else {
            throw new IllegalArgumentException("Cannot handle " + origin);
        }

        // Consume messages
        QueueingConsumer consumer = new QueueingConsumer(channel);
        channel.basicConsume(queue, false, consumer);
        System.out.println("Subscribed to " + queue + " using no timeout");
        while (true) {
            QueueingConsumer.Delivery delivery = consumer.nextDelivery();
            System.out.println("<<< " + delivery.getEnvelope() + " " + delivery.getProperties());

            String message = new String(delivery.getBody());
            // TODO doWork(message); 
            // TODO System.out.println(" [x] Done" );

            // channel.basicAck(delivery.getEnvelope().getDeliveryTag(), false);
        }
    }

    public static void main(String... args) {
        try {
            System.exit(new MvnRelease().run(args));
        } catch (Throwable t) {
            t.printStackTrace(System.err);
            System.exit(1);
        }
    }
}