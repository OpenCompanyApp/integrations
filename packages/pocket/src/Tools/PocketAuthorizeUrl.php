<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Build the Pocket browser authorization URL. */
class PocketAuthorizeUrl extends AbstractPocketTool { protected const NAME = 'pocket_authorize_url'; protected const DESCRIPTION = 'Build the Pocket web authorization URL from request_token and redirect_uri, with optional mobile or webauthenticationbroker fields.'; protected const METHOD = 'authorizeUrlFromPayload'; protected const REQUIRED = ['request_token', 'redirect_uri']; }
