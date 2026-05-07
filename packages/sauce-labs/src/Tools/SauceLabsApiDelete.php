<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Execute a safe relative Sauce Labs DELETE call. */
class SauceLabsApiDelete extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_api_delete'; protected const DESCRIPTION = 'Call a safe relative Sauce Labs DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
