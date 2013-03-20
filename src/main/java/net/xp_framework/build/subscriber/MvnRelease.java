package net.xp_framework.build.subscriber;

import org.json.JSONObject;
import java.io.File;
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

        // Invoke maven
        int exit = new MavenCli().doMain(
            new String[] { "package" }, 
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