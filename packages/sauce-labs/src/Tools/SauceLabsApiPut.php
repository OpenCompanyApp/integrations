<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Execute a safe relative Sauce Labs PUT call. */
class SauceLabsApiPut extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_api_put'; protected const DESCRIPTION = 'Call a safe relative Sauce Labs PUT path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPut'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
