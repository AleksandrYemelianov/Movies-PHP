<?php

namespace App\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private $errors = [];

    private $data;

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;

        foreach ($rules as $key => $rule) {
            $rules = $rule;
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;
                $error = $this->validateRule($key, $ruleName, $ruleValue);
                if ($error) {
                    $this->errors[$key][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    private function validateRule(string $key, string $ruleName, ?string $ruleValue = null): string|false
    {

        $valueInput = $this->data[$key];
        switch ($ruleName) {
            case 'require':
                if (empty($valueInput)) {
                    return "Field $key is required";
                }
                break;
            case 'min':
                if (strlen($valueInput) < $ruleValue) {
                    return "Field $key must be at least $ruleValue characters long";
                }
                break;
            case 'max':
                if (strlen($valueInput) > $ruleValue) {
                    return "Field $key must be at most $ruleValue characters long";
                }
                break;
            case 'email':
                if (! filter_var($valueInput, FILTER_VALIDATE_EMAIL)) {
                    return 'Field must be a valid email address';
                }
                break;
        }

        return false;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
