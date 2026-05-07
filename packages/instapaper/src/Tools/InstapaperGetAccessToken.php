<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Exchange xAuth credentials for an Instapaper OAuth access token. */
class InstapaperGetAccessToken extends AbstractInstapaperTool { protected const NAME = 'instapaper_get_access_token'; protected const DESCRIPTION = 'Exchange xAuth username and password for an Instapaper OAuth access token and token secret.'; protected const OPERATION = 'get_access_token'; protected const REQUIRED = ['x_auth_username', 'x_auth_password']; }
