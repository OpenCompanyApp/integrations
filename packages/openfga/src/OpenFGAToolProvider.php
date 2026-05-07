<?php

namespace OpenCompany\Integrations\OpenFGA;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for OpenFGA.
 *
 * Exposes the official OpenFGA Swagger operation set as endpoint-specific agent
 * tools and resolves account-specific base URLs and bearer tokens.
 */
class OpenFGAToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'optional_bearer_token','legacy_auth_type'=>'api_token','credential_mode'=>'optional_secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Self-hosted OpenFGA can run without auth; hosted/protected deployments can send Authorization: Bearer <token>.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'openfga'; } public function appMeta(): array { return ['label'=>'OpenFGA','description'=>'Fine-grained authorization stores, models, tuples, checks, list objects, and AuthZEN APIs','icon'=>'ph:key','logo'=>'ph:key']; }
    public function integrationMeta(): array { return ['name'=>'OpenFGA','description'=>'Manage OpenFGA stores, authorization models, tuple reads/writes, checks, expansions, list objects/users, changes, and AuthZEN endpoints.','icon'=>'ph:key','logo'=>'ph:key','category'=>'data','badge'=>'verified','docs_url'=>'https://openfga.dev/docs']; }
    public function configSchema(): array { return [['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>true,'default'=>'http://localhost:8080'],['key'=>'api_token','type'=>'secret','label'=>'Bearer Token','required'=>false]]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $baseUrl=rtrim((string)($config['url']??'http://localhost:8080'),'/'); $token=(string)($config['api_token']??''); try{ $headers=['Accept'=>'application/json']; if($token!=='') $headers['Authorization']='Bearer '.$token; $response=Http::withHeaders($headers)->timeout(10)->get($baseUrl.'/stores'); if(!$response->successful()) return ['success'=>false,'error'=>'OpenFGA API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to OpenFGA at '.$baseUrl.'.']; }catch(\Throwable $e){ return ['success'=>false,'error'=>$e->getMessage()]; } }
    public function validationRules(): array { return ['url'=>'required|url','api_token'=>'nullable|string']; } public function credentialFields(): array { return [['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>true,'default'=>'http://localhost:8080'],['key'=>'api_token','type'=>'secret','label'=>'Bearer Token','required'=>false]]; }
    public function tools(): array { return [
  'openfga_get_configuration' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAGetConfiguration',
  'type' => 'read',
  'name' => 'Get Configuration',
  'description' => '[Experimental] The GetConfiguration API returns metadata about the Policy Decision Point (PDP) including its name, version, supported endpoints, and capabilities. This endpoint follows the AuthZEN specification for PDP discovery. Following the AuthZEN spec\'s m',
  'icon' => 'ph:key',
),
  'openfga_list_stores' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAListStores',
  'type' => 'read',
  'name' => 'List Stores',
  'description' => 'Returns a paginated list of OpenFGA stores and a continuation token to get additional stores. The continuation token will be empty if there are no more stores.  Official OpenFGA endpoint: GET /stores.',
  'icon' => 'ph:key',
),
  'openfga_create_store' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGACreateStore',
  'type' => 'write',
  'name' => 'Create Store',
  'description' => 'Create a unique OpenFGA store which will be used to store authorization models and relationship tuples.  Official OpenFGA endpoint: POST /stores.',
  'icon' => 'ph:pencil-simple',
),
  'openfga_get_store' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAGetStore',
  'type' => 'read',
  'name' => 'Get Store',
  'description' => 'Returns an OpenFGA store by its identifier  Official OpenFGA endpoint: GET /stores/{store_id}.',
  'icon' => 'ph:key',
),
  'openfga_delete_store' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGADeleteStore',
  'type' => 'write',
  'name' => 'Delete Store',
  'description' => 'Delete an OpenFGA store. This does not delete the data associated with the store, like tuples or authorization models.  Official OpenFGA endpoint: DELETE /stores/{store_id}.',
  'icon' => 'ph:pencil-simple',
),
  'openfga_evaluation' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAEvaluation',
  'type' => 'write',
  'name' => 'Evaluation',
  'description' => '[Experimental] The Evaluation API determines whether a subject is authorized to perform an action on a resource. This endpoint implements the AuthZEN Access Evaluation API specification. ## Request Structure The request requires three components: - **subject**',
  'icon' => 'ph:pencil-simple',
),
  'openfga_evaluations' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAEvaluations',
  'type' => 'write',
  'name' => 'Evaluations',
  'description' => '[Experimental] The Evaluations API allows batch authorization checks in a single request. It supports request-level defaults for subject, action, resource, and context that can be overridden per evaluation item. ## Evaluation Semantics The `options.evaluations',
  'icon' => 'ph:pencil-simple',
),
  'openfga_action_search' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAActionSearch',
  'type' => 'write',
  'name' => 'Action Search',
  'description' => '[Experimental] The ActionSearch API returns all actions (relations) that a subject can perform on a specific resource. This is useful for answering questions like "What can Anne do with this document?" or building dynamic UIs that show only the actions a user ',
  'icon' => 'ph:pencil-simple',
),
  'openfga_resource_search' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAResourceSearch',
  'type' => 'write',
  'name' => 'Resource Search',
  'description' => '[Experimental] The ResourceSearch API returns all resources of a given type that a subject has a specific action (relation) on. This is useful for answering questions like "What documents can Anne read?" or "What folders can Bob administer?" The resource type ',
  'icon' => 'ph:pencil-simple',
),
  'openfga_subject_search' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGASubjectSearch',
  'type' => 'write',
  'name' => 'Subject Search',
  'description' => '[Experimental] The SubjectSearch API returns all subjects that have a specific action (relation) on a given resource. This is useful for answering questions like "Who can read this document?" or "Who can administer this folder?" Results can be filtered by subj',
  'icon' => 'ph:pencil-simple',
),
  'openfga_read_assertions' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAReadAssertions',
  'type' => 'read',
  'name' => 'Read Assertions',
  'description' => 'The ReadAssertions API will return, for a given authorization model id, all the assertions stored for it.  Official OpenFGA endpoint: GET /stores/{store_id}/assertions/{authorization_model_id}.',
  'icon' => 'ph:key',
),
  'openfga_write_assertions' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAWriteAssertions',
  'type' => 'write',
  'name' => 'Write Assertions',
  'description' => 'The WriteAssertions API will upsert new assertions for an authorization model id, or overwrite the existing ones. An assertion is an object that contains a tuple key, the expectation of whether a call to the Check API of that tuple key will return true or fals',
  'icon' => 'ph:pencil-simple',
),
  'openfga_read_authorization_models' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAReadAuthorizationModels',
  'type' => 'read',
  'name' => 'Read Authorization Models',
  'description' => 'The ReadAuthorizationModels API will return all the authorization models for a certain store. OpenFGA\'s response will contain an array of all authorization models, sorted in descending order of creation. ## Example Assume that a store\'s authorization model has',
  'icon' => 'ph:key',
),
  'openfga_write_authorization_model' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAWriteAuthorizationModel',
  'type' => 'write',
  'name' => 'Write Authorization Model',
  'description' => 'The WriteAuthorizationModel API will add a new authorization model to a store. Each item in the `type_definitions` array is a type definition as specified in the field `type_definition`. The response will return the authorization model\'s ID in the `id` field. ',
  'icon' => 'ph:pencil-simple',
),
  'openfga_read_authorization_model' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAReadAuthorizationModel',
  'type' => 'read',
  'name' => 'Read Authorization Model',
  'description' => 'The ReadAuthorizationModel API returns an authorization model by its identifier. The response will return the authorization model for the particular version. ## Example To retrieve the authorization model with ID `01G5JAVJ41T49E9TT3SKVS7X1J` for the store, cal',
  'icon' => 'ph:key',
),
  'openfga_batch_check' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGABatchCheck',
  'type' => 'write',
  'name' => 'Batch Check',
  'description' => 'The `BatchCheck` API functions nearly identically to `Check`, but instead of checking a single user-object relationship BatchCheck accepts a list of relationships to check and returns a map containing `BatchCheckItem` response for each check it received. An as',
  'icon' => 'ph:pencil-simple',
),
  'openfga_read_changes' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAReadChanges',
  'type' => 'read',
  'name' => 'Read Changes',
  'description' => 'The ReadChanges API will return a paginated list of tuple changes (additions and deletions) that occurred in a given store, sorted by ascending time. The response will include a continuation token that is used to get the next set of changes. If there are no ch',
  'icon' => 'ph:key',
),
  'openfga_check' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGACheck',
  'type' => 'write',
  'name' => 'Check',
  'description' => 'The Check API returns whether a given user has a relationship with a given object in a given store. The `user` field of the request can be a specific target, such as `user:anne`, or a userset (set of users) such as `group:marketing#member` or a type-bound publ',
  'icon' => 'ph:pencil-simple',
),
  'openfga_expand' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAExpand',
  'type' => 'write',
  'name' => 'Expand',
  'description' => 'The Expand API will return all users and usersets that have certain relationship with an object in a certain store. This is different from the `/stores/{store_id}/read` API in that both users and computed usersets are returned. Body parameters `tuple_key.objec',
  'icon' => 'ph:pencil-simple',
),
  'openfga_list_objects' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAListObjects',
  'type' => 'write',
  'name' => 'List Objects',
  'description' => 'The ListObjects API returns a list of all the objects of the given type that the user has a relation with. To arrive at a result, the API uses: an authorization model, explicit tuples written through the Write API, contextual tuples present in the request, and',
  'icon' => 'ph:pencil-simple',
),
  'openfga_list_users' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAListUsers',
  'type' => 'write',
  'name' => 'List Users',
  'description' => 'The ListUsers API returns a list of all the users of a specific type that have a relation to a given object. To arrive at a result, the API uses: an authorization model, explicit tuples written through the Write API, contextual tuples present in the request, a',
  'icon' => 'ph:pencil-simple',
),
  'openfga_read' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGARead',
  'type' => 'write',
  'name' => 'Read',
  'description' => 'The Read API will return the tuples for a certain store that match a query filter specified in the body of the request. The API doesn\'t guarantee order by any field. It is different from the `/stores/{store_id}/expand` API in that it only returns relationship ',
  'icon' => 'ph:pencil-simple',
),
  'openfga_streamed_list_objects' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAStreamedListObjects',
  'type' => 'write',
  'name' => 'Streamed List Objects',
  'description' => 'The Streamed ListObjects API is very similar to the the ListObjects API, with two differences: 1. Instead of collecting all objects before returning a response, it streams them to the client as they are collected. 2. The number of results returned is only limi',
  'icon' => 'ph:pencil-simple',
),
  'openfga_write' => array (
  'class' => 'OpenCompany\\Integrations\\OpenFGA\\Tools\\OpenFGAWrite',
  'type' => 'write',
  'name' => 'Write',
  'description' => 'The Write API will transactionally update the tuples for a certain store. Tuples and type definitions allow OpenFGA to determine whether a relationship exists between an object and an user. In the body, `writes` adds new tuples and `deletes` removes existing t',
  'icon' => 'ph:pencil-simple',
),
    ]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/openfga.md'; }
    /** @param  array<string, mixed>  $context  Runtime account context. */ private function resolveService(array $context=[]): OpenFGAService { $account=$context['account']??null; if($account!==null){ $creds=app(CredentialResolver::class); return new OpenFGAService(apiToken:$creds->get('openfga','api_token','',$account), baseUrl:$creds->get('openfga','url','http://localhost:8080',$account)); } return app(OpenFGAService::class); }
}
