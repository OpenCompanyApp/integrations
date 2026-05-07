<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get app bitrise.yml. */
class BitriseGetBitriseYml extends AbstractBitriseTool { protected const NAME = 'bitrise_get_bitrise_yml'; protected const DESCRIPTION = 'Get the bitrise.yml configuration for an app.'; protected const METHOD = 'getBitriseYml'; protected const ARGUMENTS = ['app_slug']; }
