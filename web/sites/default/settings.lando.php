<?php

/**
 * Lando Environment - override live environment settings for development.
 */
if (getenv('LANDO_INFO')) {
  $lando_info = json_decode(getenv('LANDO_INFO'), TRUE);

  $settings['trusted_host_patterns'] = ['.*'];
  $settings['hash_salt'] = md5(getenv('LANDO_HOST_IP'));

  $databases['default']['default'] = array (
    'database' => $lando_info['database']['creds']['database'],
    'username' => $lando_info['database']['creds']['user'],
    'password' => $lando_info['database']['creds']['password'],
    'host' => $lando_info['database']['internal_connection']['host'],
    'port' => $lando_info['database']['internal_connection']['port'],
    'driver' => 'mysql',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  );

  $config['captcha.captcha_point.user_register_form']['status'] = FALSE;
  $config['system.mail']['interface']['default'] = 'devel_mail_log';
  $settings['file_private_path'] = '/app/private';
  $settings['file_temp_path'] = '/tmp';
  $config['config_split.config_split.development']['status'] = FALSE;

  $config['environment_indicator.indicator']['bg_color'] = '#2D2F56';
  $config['environment_indicator.indicator']['fg_color'] = '#ffffff';
  $config['environment_indicator.indicator']['name'] = 'DevLando';
}
