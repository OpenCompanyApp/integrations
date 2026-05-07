<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Execute a safe relative Sauce Labs GET call. */
class SauceLabsApiGet extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_api_get'; protected const DESCRIPTION = 'Call a safe relative Sauce Labs GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
