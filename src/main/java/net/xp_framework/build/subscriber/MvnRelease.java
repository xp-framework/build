package net.xp_framework.build.subscriber;

import org.json.JSONObject;

/**
 * Builds maven releases
 */
public class MvnRelease extends AbstractSubscriber {

    /**
     * Handle payload
     */
    public void handle(JSONObject payload) {
        System.out.println(payload.toString(2));
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