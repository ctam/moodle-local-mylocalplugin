<?php
namespace local_mylocalplugin\task;

class scheduled_task extends \core\task\scheduled_task {
    public function get_name() {
        // Shown in admin screens
        // return get_string('cutmytoenails', 'mod_hygene');
        return 'My local plugin scheduled task';
    }

    public function execute() {
        // apply fungus cream
        // apply chainsaw
        // apply olive oil
    }
}