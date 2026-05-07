<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Create a Pocket OAuth request token. */
class PocketRequestToken extends AbstractPocketTool { protected const NAME = 'pocket_request_token'; protected const DESCRIPTION = 'Create a Pocket OAuth request token for a redirect_uri, with optional state.'; protected const METHOD = 'requestToken'; protected const REQUIRED = ['redirect_uri']; }
