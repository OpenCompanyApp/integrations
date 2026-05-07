<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Unpublishes a changelog, removing it from public view. */
class FeaturebaseUnpublishChangelog extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_unpublish_changelog'; protected const DESCRIPTION = 'Unpublishes a changelog, removing it from public view.'; protected const OPERATION = 'unpublishchangelog'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
