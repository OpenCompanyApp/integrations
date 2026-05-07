<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get the bitrise.yml used by one build. */
class BitriseGetBuildBitriseYml extends AbstractBitriseTool { protected const NAME = 'bitrise_get_build_bitrise_yml'; protected const DESCRIPTION = 'Get the bitrise.yml configuration used by one Bitrise build.'; protected const METHOD = 'getBuildBitriseYml'; protected const ARGUMENTS = ['app_slug', 'build_slug']; }
