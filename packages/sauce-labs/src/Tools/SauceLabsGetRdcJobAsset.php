<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Get a Sauce Labs real device job asset. */
class SauceLabsGetRdcJobAsset extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_rdc_job_asset'; protected const DESCRIPTION = 'Get a Sauce Labs real device job asset such as deviceLogs, video.mp4, or network.har.'; protected const METHOD = 'getRdcJobAsset'; protected const ARGUMENTS = ['job_id', 'asset_type']; }
