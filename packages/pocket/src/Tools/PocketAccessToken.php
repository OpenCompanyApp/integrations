<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Exchange a Pocket request token for an access token. */
class PocketAccessToken extends AbstractPocketTool { protected const NAME = 'pocket_access_token'; protected const DESCRIPTION = 'Exchange an approved Pocket request token code for an access token and username.'; protected const METHOD = 'accessToken'; protected const REQUIRED = ['code']; }
