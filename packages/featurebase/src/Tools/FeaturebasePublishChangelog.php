<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Publishes a changelog and optionally sends an email notification to subscribers. */
class FeaturebasePublishChangelog extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_publish_changelog'; protected const DESCRIPTION = 'Publishes a changelog and optionally sends an email notification to subscribers.'; protected const OPERATION = 'publishchangelog'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
