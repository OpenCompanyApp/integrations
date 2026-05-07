<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * validate routing numbers.
 *
 * Maps to the official Modern Treasury endpoint get /api/validations/routing_numbers.
 */
class ModernTreasuryValidateRoutingNumber extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_validate_routing_number';
    protected const DESCRIPTION = 'validate routing numbers

Official Modern Treasury endpoint: GET /api/validations/routing_numbers

Validates the routing number information supplied without creating a routing detail';
    protected const PARAMETERS = array (
  'routing_number' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `routing_number` from the official Modern Treasury API operation.',
  ),
  'routing_number_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `routing_number_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'aba',
      1 => 'au_bsb',
      2 => 'br_codigo',
      3 => 'ca_cpa',
      4 => 'chips',
      5 => 'cnaps',
      6 => 'dk_interbank_clearing_code',
      7 => 'gb_sort_code',
      8 => 'hk_interbank_clearing_code',
      9 => 'hu_interbank_clearing_code',
      10 => 'id_sknbi_code',
      11 => 'il_bank_code',
      12 => 'in_ifsc',
      13 => 'jp_zengin_code',
      14 => 'mx_bank_identifier',
      15 => 'my_branch_code',
      16 => 'nz_national_clearing_code',
      17 => 'pl_national_clearing_code',
      18 => 'se_bankgiro_clearing_code',
      19 => 'sg_interbank_clearing_code',
      20 => 'swift',
      21 => 'za_national_clearing_code',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/validations/routing_numbers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'routing_number' => 'routing_number',
  'routing_number_type' => 'routing_number_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
