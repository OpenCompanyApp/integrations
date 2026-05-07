<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds different types of items to a board using files from a device. You can add up to 20 items of the same or different type per create call. For example, you can create 5 document items and 5 images in one create call. The bulk create operation is transactional. If any item's create operation fails, the create operation for all the remaining items also fails, and none of the items will be created. To try out this API in our documentation: 1. In the **BODY PARAMS** section, select **ADD FILE**, and then upload a local file. Repeat for each item that you want to add. 2. Upload a JSON file that contains the bulk data for the items you want to create. Required scope boards:write Rate limiting Level 2 per item.
 *
 * Maps to the official Miro endpoint POST /v2/boards/{board_id_Platformcreateitemsinbulkusingfilefromdevice}/items/bulk.
 */
class MiroCreateItemsInBulkUsingFileFromDevice extends AbstractMiroTool
{
    protected const NAME = 'miro_create_items_in_bulk_using_file_from_device';
    protected const DESCRIPTION = 'Adds different types of items to a board using files from a device. You can add up to 20 items of the same or different type per create call. For example, you can create 5 document items and 5 images in one create call. The bulk create operation is transactional. If any item\'s create operation fails, the create operation for all the remaining items also fails, and none of the items will be created. To try out this API in our documentation: 1. In the **BODY PARAMS** section, select **ADD FILE**, and then upload a local file. Repeat for each item that you want to add. 2. Upload a JSON file that contains the bulk data for the items you want to create. Required scope boards:write Rate limiting Level 2 per item

Official Miro endpoint: POST /v2/boards/{board_id_Platformcreateitemsinbulkusingfilefromdevice}/items/bulk.';
    protected const PARAMETERS = array (
      'board_id_platformcreateitemsinbulkusingfilefromdevice' => array (
        'type' => 'string',
        'description' => 'board_id_Platformcreateitemsinbulkusingfilefromdevice path parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards/{board_id_Platformcreateitemsinbulkusingfilefromdevice}/items/bulk';
    protected const PATH_PARAMS = array (
      'board_id_Platformcreateitemsinbulkusingfilefromdevice' => 'board_id_platformcreateitemsinbulkusingfilefromdevice',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'multipart/form-data';
}
