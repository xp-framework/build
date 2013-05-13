package net.xp_framework.build.subscriber;

import org.json.JSONObject;
import java.io.File;
import java.io.FileOutputStream;
import java.util.Properties;
import java.util.ArrayList;
import org.apache.maven.cli.MavenCli;

/**
 * Builds maven releases
 */
public class MvnRelease extends AbstractSubscriber {

    /**
     * Handle payload
     */
    public void handle(JSONObject payload) {
        JSONObject build = payload.getJSONObject("build");

        File checkout = new File(payload.getString("checkout"), build.optString("base"));
        System.out.println("Checkout @" + checkout);

        // Prepare arguments. See http://maven.apache.org/guides/mini/guide-releasing.html
        ArrayList<String> arguments = new ArrayList<String>();
        arguments.add("-B"); 
        arguments.add("release:perform");
        arguments.add("-DpushChanges=false");
        arguments.add("-DremoteTagging=false");
        arguments.add("-Dexec.additionalArguments=-Psonatype-oss-release");
        System.out.println("Arguments @" + arguments);

        // Create release properties
        Properties properties = new Properties();
        properties.setProperty("checkpoint.transformed-pom-for-release", "OK");
        properties.setProperty("checkpoint.transform-pom-for-development", "OK");
        properties.setProperty("checkpoint.local-modifications-checked", "OK");
        properties.setProperty("checkpoint.initialized", "OK");
        properties.setProperty("checkpoint.checked-in-release-version", "OK");
        properties.setProperty("checkpoint.tagged-release", "OK");
        properties.setProperty("checkpoint.prepared-release", "OK");
        properties.setProperty("checkpoint.check-in-development-version", "OK");
        properties.setProperty("scm.tag", "r" + payload.getString("release"));
        properties.setProperty("scm.url", "scm:git:" + checkout.toURI());

        try {
            properties.store(new FileOutputStream(new File(checkout, "release.properties")), "");
        } catch (java.io.IOException e) {
            throw new RuntimeException("Cannot store release properties", e);
        }

        // Invoke maven
        int exit = new MavenCli().doMain(
            arguments.toArray(new String[] {}),
            checkout.getAbsolutePath(), 
            System.out, 
            System.err
        );
        if (0 != exit) {
            throw new IllegalStateException("Build failed.");
        }
    }

    /**
     * Make this runnable via command line
     */
    public static void main(String... args) {
        try {
            System.exit(new MvnRelease().run(args));
        } catch (Throwable t) {
            t.printStackTrace(System.err);
            System.exit(1);
        }
    }
}