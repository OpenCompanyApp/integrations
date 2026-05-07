<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Execute a safe relative Bitrise API PUT call. */
class BitriseApiPut extends AbstractBitriseTool { protected const NAME = 'bitrise_api_put'; protected const DESCRIPTION = 'Call a safe relative Bitrise API PUT path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPut'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
