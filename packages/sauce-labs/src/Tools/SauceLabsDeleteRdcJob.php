<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Delete one Sauce Labs real device job. */
class SauceLabsDeleteRdcJob extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_delete_rdc_job'; protected const DESCRIPTION = 'Delete one Sauce Labs real device job and assets.'; protected const METHOD = 'deleteRdcJob'; protected const ARGUMENTS = ['job_id']; }
