<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List build artifacts for a Bitrise build. */
class BitriseListArtifacts extends AbstractBitriseTool { protected const NAME = 'bitrise_list_artifacts'; protected const DESCRIPTION = 'List build artifacts for a Bitrise build.'; protected const METHOD = 'listArtifacts'; protected const ARGUMENTS = ['app_slug', 'build_slug']; protected const USE_QUERY = true; }
