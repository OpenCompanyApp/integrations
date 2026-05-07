<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** List Sauce Labs v2 builds. */
class SauceLabsListBuilds extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_list_builds'; protected const DESCRIPTION = 'List Sauce Labs v2 builds for build_source rdc or vdc.'; protected const METHOD = 'listBuilds'; protected const ARGUMENTS = ['build_source']; protected const USE_QUERY = true; }
