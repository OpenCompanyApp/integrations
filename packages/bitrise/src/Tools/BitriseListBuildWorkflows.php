<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List workflows triggered for a Bitrise app. */
class BitriseListBuildWorkflows extends AbstractBitriseTool { protected const NAME = 'bitrise_list_build_workflows'; protected const DESCRIPTION = 'List workflows that have been triggered for a Bitrise app.'; protected const METHOD = 'listBuildWorkflows'; protected const ARGUMENTS = ['app_slug']; }
