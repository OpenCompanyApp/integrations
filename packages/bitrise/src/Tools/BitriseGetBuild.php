<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get one Bitrise build. */
class BitriseGetBuild extends AbstractBitriseTool { protected const NAME = 'bitrise_get_build'; protected const DESCRIPTION = 'Get one build for a Bitrise app.'; protected const METHOD = 'getBuild'; protected const ARGUMENTS = ['app_slug', 'build_slug']; }
