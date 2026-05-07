<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Get one Sauce Labs v2 build. */
class SauceLabsGetBuild extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_build'; protected const DESCRIPTION = 'Get one Sauce Labs v2 build by source and build id.'; protected const METHOD = 'getBuild'; protected const ARGUMENTS = ['build_source', 'build_id']; }
