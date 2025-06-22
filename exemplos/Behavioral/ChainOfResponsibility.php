<?php

// Interface Handler
interface PasswordValidator
{
    public function setNext(PasswordValidator $validator): PasswordValidator;
    public function validate(string $password): ?string;
}

// Classe base abstrata
abstract class AbstractPasswordValidator implements PasswordValidator
{
    private ?PasswordValidator $nextValidator = null;

    public function setNext(PasswordValidator $validator): PasswordValidator
    {
        $this->nextValidator = $validator;
        return $validator;
    }

    public function validate(string $password): ?string
    {
        if ($this->nextValidator) {
            return $this->nextValidator->validate($password);
        }

        return "Senha válida! 🎉";
    }
}

// Validadores concretos
class SpecialCharacterValidator extends AbstractPasswordValidator
{
    public function validate(string $password): ?string
    {
        if (!preg_match('/[\W]/', $password)) {
            return "Erro: A senha deve conter pelo menos um caractere especial.";
        }
        return parent::validate($password);
    }
}

class UppercaseValidator extends AbstractPasswordValidator
{
    public function validate(string $password): ?string
    {
        if (!preg_match('/[A-Z]/', $password)) {
            return "Erro: A senha deve conter pelo menos uma letra maiúscula.";
        }
        return parent::validate($password);
    }
}

class NumberValidator extends AbstractPasswordValidator
{
    public function validate(string $password): ?string
    {
        if (!preg_match('/\d/', $password)) {
            return "Erro: A senha deve conter pelo menos um número.";
        }
        return parent::validate($password);
    }
}

class LengthValidator extends AbstractPasswordValidator
{
    public function validate(string $password): ?string
    {
        if (strlen($password) <= 10) {
            return "Erro: A senha deve ter mais de 10 caracteres.";
        }
        return parent::validate($password);
    }
}

// Serviço de cadastro
class RegistrationService
{
    private PasswordValidator $validatorChain;

    public function __construct()
    {
        // Monta a cadeia de validação
        $this->validatorChain = new SpecialCharacterValidator();
        $this->validatorChain
            ->setNext(new UppercaseValidator())
            ->setNext(new NumberValidator())
            ->setNext(new LengthValidator());
    }

    public function register(string $password): void
    {
        $result = $this->validatorChain->validate($password);
        echo $result . PHP_EOL;
    }
}

// Testes
$service = new RegistrationService();

echo "Teste 1: senha fraca\n";
$service->register("senha123");

echo "\nTeste 2: senha sem caractere especial\n";
$service->register("Senha123456");

echo "\nTeste 3: senha válida\n";
$service->register("Senha@12345");