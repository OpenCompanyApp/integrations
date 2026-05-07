<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Execute a safe relative Bitrise API GET call. */
class BitriseApiGet extends AbstractBitriseTool { protected const NAME = 'bitrise_api_get'; protected const DESCRIPTION = 'Call a safe relative Bitrise API GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
