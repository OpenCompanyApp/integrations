# SurveyMonkey — JavaScript API Reference

## list_surveys

List all surveys in your SurveyMonkey account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of surveys per page (default: 50, max: 100) |

### Examples

```js
var result = app.integrations.surveymonkey.list_surveys({
  page: 1,
  per_page: 10,
})

for (const survey of (result.data)) {
  console.log(survey.id + ": " + survey.title)
}
```
---

## get_survey

Get details of a specific survey by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |

### Examples

```js
var result = app.integrations.surveymonkey.get_survey({
  survey_id: "123456789",
})

console.log("Title: " + result.title)
console.log("Questions: " + result.pages.length)
```
---

## create_survey

Create a new blank survey with a given title.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The title for the new survey |

### Examples

```js
var result = app.integrations.surveymonkey.create_survey({
  title: "Customer Satisfaction Q1",
})

console.log("Created survey: " + result.id)
```
---

## list_responses

List all bulk responses for a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of responses per page (default: 50, max: 100) |

### Examples

```js
var result = app.integrations.surveymonkey.list_responses({
  survey_id: "123456789",
  per_page: 25,
})

for (const response of (result.data)) {
  console.log(response.id + " - " + response.date_modified)
}
```
---

## get_response

Get a single response for a survey by response ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `response_id` | string | yes | The response ID |

### Examples

```js
var result = app.integrations.surveymonkey.get_response({
  survey_id: "123456789",
  response_id: "987654321",
})

console.log("Respondent: " + (result.recipient_email || "anonymous"))
for (const page of (result.pages)) {
  for (const answer of (page.answers)) {
    console.log("Q" + answer.question_id + ": " + (answer.text || "selected"))
  }
}
```
---

## list_collectors

List all collectors for a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |

### Examples

```js
var result = app.integrations.surveymonkey.list_collectors({
  survey_id: "123456789",
})

for (const collector of (result.data)) {
  console.log(collector.id + ": " + collector.name + " (" + collector.type + ")")
}
```
---

## create_collector

Create a collector for distributing a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `type` | string | yes | Collector type: `"weblink"` or `"email"` |
| `name` | string | no | A display name for the collector |

### Examples

```js
var result = app.integrations.surveymonkey.create_collector({
  survey_id: "123456789",
  type: "weblink",
  name: "Website Feedback Link",
})

console.log("Collector URL: " + result.url)
```
---

## get_current_user

Get details of the currently authenticated SurveyMonkey user.

### Parameters

None.

### Examples

```js
var result = app.integrations.surveymonkey.get_current_user({})

console.log("User: " + result.first_name + " " + result.last_name)
console.log("Email: " + result.email)
console.log("Plan: " + (result.group_type || "free"))
```
---

## Multi-Account Usage

If you have multiple SurveyMonkey accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.surveymonkey.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.surveymonkey.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.surveymonkey.work.function_name({ /* parameters */ })
app.integrations.surveymonkey.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
