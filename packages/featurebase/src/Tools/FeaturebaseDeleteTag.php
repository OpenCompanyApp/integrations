<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Deletes a conversation tag from the workspace catalog and removes it from aggregate conversation tag state. Archived and historical part applications remain part of the audit trail where applicable. */
class FeaturebaseDeleteTag extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_tag'; protected const DESCRIPTION = 'Deletes a conversation tag from the workspace catalog and removes it from aggregate conversation tag state. Archived and historical part applications remain part of the audit trail where applicable.'; protected const OPERATION = 'deletetag'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
