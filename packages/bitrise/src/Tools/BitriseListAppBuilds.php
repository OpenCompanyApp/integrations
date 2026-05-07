<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List recent builds for a Bitrise app. */
class BitriseListAppBuilds extends AbstractBitriseTool { protected const NAME = 'bitrise_list_app_builds'; protected const DESCRIPTION = 'List recent builds for a Bitrise app with optional filters such as branch or workflow.'; protected const METHOD = 'listAppBuilds'; protected const ARGUMENTS = ['app_slug']; protected const USE_QUERY = true; }
