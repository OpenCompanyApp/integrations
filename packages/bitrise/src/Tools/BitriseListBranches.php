<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List repository branches for a Bitrise app. */
class BitriseListBranches extends AbstractBitriseTool { protected const NAME = 'bitrise_list_branches'; protected const DESCRIPTION = 'List repository branches for a Bitrise app.'; protected const METHOD = 'listBranches'; protected const ARGUMENTS = ['app_slug']; protected const USE_QUERY = true; }
