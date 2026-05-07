<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** List Sauce Labs supported platforms. */
class SauceLabsListPlatforms extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_list_platforms'; protected const DESCRIPTION = 'List Sauce Labs supported platforms for all, appium, or webdriver.'; protected const METHOD = 'listPlatforms'; protected const ARGUMENTS = ['automation_api']; protected const OPTIONAL = ['automation_api']; }
