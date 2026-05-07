<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Lookup the Sauce Labs build for a known job. */
class SauceLabsGetJobBuild extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_job_build'; protected const DESCRIPTION = 'Lookup the Sauce Labs v2 build associated with a known job.'; protected const METHOD = 'getJobBuild'; protected const ARGUMENTS = ['build_source', 'job_id']; }
