<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get one Bitrise build log. */
class BitriseGetBuildLog extends AbstractBitriseTool { protected const NAME = 'bitrise_get_build_log'; protected const DESCRIPTION = 'Get the build log for one Bitrise build.'; protected const METHOD = 'getBuildLog'; protected const ARGUMENTS = ['app_slug', 'build_slug']; }
