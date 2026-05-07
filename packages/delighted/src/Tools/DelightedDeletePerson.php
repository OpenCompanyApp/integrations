<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Delete a Delighted person. */
class DelightedDeletePerson extends AbstractDelightedTool { protected const NAME = 'delighted_delete_person'; protected const DESCRIPTION = 'Delete a Delighted person by id, email:address, or phone_number:number identifier.'; protected const OPERATION = 'delete_person'; protected const REQUIRED = ['person_identifier']; }
