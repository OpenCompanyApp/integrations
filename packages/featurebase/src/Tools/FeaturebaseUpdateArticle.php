<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates an existing article. Only include the fields you wish to update. */
class FeaturebaseUpdateArticle extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_article'; protected const DESCRIPTION = 'Updates an existing article. Only include the fields you wish to update.'; protected const OPERATION = 'updatearticle'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
