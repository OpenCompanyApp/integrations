<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** List jobs in a Sauce Labs v2 build. */
class SauceLabsListBuildJobs extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_list_build_jobs'; protected const DESCRIPTION = 'List Sauce Labs jobs associated with a v2 build.'; protected const METHOD = 'listBuildJobs'; protected const ARGUMENTS = ['build_source', 'build_id']; protected const USE_QUERY = true; }
