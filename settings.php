<?php
// It is possible to add new items and categories to the admin_tree block.
// I you need to define new admin setting classes put them into separate
// file and require_once() from settings.php

// For example if you want to add new external page use following

$ADMIN->add('root', new admin_category('tweaks', 'Custom tweaks'));
$ADMIN->add('tweaks', new admin_externalpage('mylocalplugin', 'Tweak something',
            $CFG->wwwroot.'/local/mylocalplugin/setuppage.php'));

$ADMIN->add('accounts', new admin_externalpage('mylocalplugin2', 'Tweak something 2',
            $CFG->wwwroot.'/local/mylocalplugin/setuppage2.php'));

// Or if you want a new standard settings page for the plugin, inside the local
// plugins category:

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) { // needs this condition or there is error on login page
    $settings = new admin_settingpage('local_mylocalplugin', 'My local plugin');

if ($ADMIN->fulltree) {

    //--- heading ---
    $settings->add(new admin_setting_heading('enrol_ldap_settings', '', get_string('pluginname_desc', 'enrol_ldap')));

    if (!function_exists('ldap_connect')) {
        $settings->add(new admin_setting_heading('enrol_phpldap_noextension', '', get_string('phpldap_noextension', 'enrol_ldap')));
    } else {
        require_once($CFG->dirroot.'/enrol/ldap/settingslib.php');
        require_once($CFG->libdir.'/ldaplib.php');

        $yesno = array(get_string('no'), get_string('yes'));

        //--- connection settings ---
        $settings->add(new admin_setting_heading('enrol_ldap_server_settings', get_string('server_settings', 'enrol_ldap'), ''));
        $settings->add(new admin_setting_configtext_trim_lower('enrol_ldap/host_url', get_string('host_url_key', 'enrol_ldap'), get_string('host_url', 'enrol_ldap'), ''));
        $settings->add(new admin_setting_configselect('enrol_ldap/start_tls', get_string('start_tls_key', 'auth_ldap'), get_string('start_tls', 'auth_ldap'), 0, $yesno));
        // Set LDAPv3 as the default. Nowadays all the servers support it and it gives us some real benefits.
        $options = array(3=>'3', 2=>'2');
        $settings->add(new admin_setting_configselect('enrol_ldap/ldap_version', get_string('version_key', 'enrol_ldap'), get_string('version', 'enrol_ldap'), 3, $options));
        $settings->add(new admin_setting_configtext_trim_lower('enrol_ldap/ldapencoding', get_string('ldap_encoding_key', 'enrol_ldap'), get_string('ldap_encoding', 'enrol_ldap'), 'utf-8'));
        $settings->add(new admin_setting_configtext_trim_lower('enrol_ldap/pagesize', get_string('pagesize_key', 'auth_ldap'), get_string('pagesize', 'auth_ldap'), LDAP_DEFAULT_PAGESIZE, true));

        //--- binding settings ---
        $settings->add(new admin_setting_heading('enrol_ldap_bind_settings', get_string('bind_settings', 'enrol_ldap'), ''));
        $settings->add(new admin_setting_configtext_trim_lower('enrol_ldap/bind_dn', get_string('bind_dn_key', 'enrol_ldap'), get_string('bind_dn', 'enrol_ldap'), ''));
        $settings->add(new admin_setting_configpasswordunmask('enrol_ldap/bind_pw', get_string('bind_pw_key', 'enrol_ldap'), get_string('bind_pw', 'enrol_ldap'), ''));
    }
}
    $ADMIN->add('localplugins', $settings);
}
