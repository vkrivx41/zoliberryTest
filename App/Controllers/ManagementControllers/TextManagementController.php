<?php

namespace App\Controllers\ManagementControllers;
use App\Validators\ParentValidator;


class TextManagementController extends ParentValidator
{
    private array $consigment = [];
    private string $default_category = "News";
    public array $error_messages = [];

    // include the management trait for extra methods
    
    use ManagementTrait;

    /**
     * takes the request after beign accepted as true, if false throws an error. It is the main method of the validation
     * @param array|object $request
     * @throws \Exception
     * @return string
     */
    public function process_request(array|object $request): string
    {
        $success = $this->accept_request($request);

        if (! $success){
            throw new \Exception("Request can't be empty");
        }

        $texts = $this->isolate_texts($request);

        return $this->validate_texts($texts);
    }



    /**
     * creates an array dedicated to transport texts accross the program and returns it
     * @param array $request
     * @return array
     */
    private function isolate_texts(array $request): array
    {
        $this->consigment = [
            'texts' => 
                [
                    'category' => trim(htmlspecialchars($request['category'] ?? $this->default_category)),
                    'title' => trim(htmlspecialchars($request['title'] ?? "")),
                    'paragraph_one' => trim(htmlspecialchars($request['paragraph_one_text'] ?? "")),
                    'paragraph_two' => trim(htmlspecialchars($request['paragraph_two_text'] ?? "")),
                    'paragraph_three' => trim(htmlspecialchars($request['paragraph_three_text'] ?? "")),
                    'paragraph_four' => trim(htmlspecialchars($request['paragraph_four_text'] ?? "")),
                    'paragraph_five' => trim(htmlspecialchars($request['paragraph_five_text'] ?? ""))
                ]
        ];

        return $this->consigment;
    }


    /**
     * Validate all the texts in the consignment array -- the array created in the isolate_texts() method
     * @param array $consigment
     * @return string
     */
    private function validate_texts(array $consigment): string
    {
        $texts = $consigment['texts'];
        $error = '';

        // validate title

        if(! $this->lengthy($texts['title'], 1, $this->title_limit)){
            $error =  "title";
            return $this->error_returner($error);
        }

        // validate pagagraph_one: mandatory

        if(! $this->lengthy($texts['paragraph_one'], 1, $this->para_limit)){
            $error =  "paragraph_one";
            return $this->error_returner($error);
        }

        // validate paragraph_two: optional

        if($texts['paragraph_two'] != ""){
            if(! $this->lengthy($texts['paragraph_two'], 1, $this->para_limit)){
                $error =  "paragraph_two";
                return $this->error_returner($error);
            }
        }

        // validate paragraph_three: optional

        if($texts['paragraph_three'] != ""){
            if(! $this->lengthy($texts['paragraph_three'], 1, $this->para_limit)){
                $error =  "paragraph_three";
                return $this->error_returner($error);
            }
        }

        // validate paragraph_four: optional

        if($texts['paragraph_four'] != ""){
            if(! $this->lengthy($texts['paragraph_four'], 1, $this->para_limit)){
                $error =  "paragraph_four";
                return $this->error_returner($error);
            }
        }

        // validate paragraph_five: optional

        if($texts['paragraph_five'] != ""){
            if(! $this->lengthy($texts['paragraph_five'], 1, $this->para_limit)){
                $error =  "paragraph_five";
                return $this->error_returner($error);
            }
        }



        return "";
    }



    /**
     * A section where all errors are defined, by their keys and values
     * @param string $error
     * @return string
     */
    private function set_errors(string $error = ''): string
    {
        $this->error_messages = [
            'title' => "Title must be 1 characters or more and not longer than {$_ENV['TITLE_COUNT']} characters",
            'paragraph_one' => "Paragraph one must be 1 characters or more and not longer than {$_ENV['PARA_COUNT']} characters",
            'paragraph_two' => "Paragraph two is optional, otherwise it must be 1 characters or more and not longer than {$_ENV['PARA_COUNT']} characters",
            'paragraph_three' => "Paragraph three is optional, otherwise it must be 1 characters or more and not longer than {$_ENV['PARA_COUNT']} characters",
            'paragraph_four' => "Paragraph four is optional, otherwise it must be 1 characters or more and not longer than {$_ENV['PARA_COUNT']} characters",
            'paragraph_five' => "Paragraph five is optional, otherwise it must be 1 characters or more and not longer than {$_ENV['PARA_COUNT']} characters",
            'upload' => "There was a problem updating your article try again later."
        ];

        if(array_key_exists($error, $this->error_messages)){
            return $this->error_messages[$error];
        }

        return '';
    }


     /**
     * essential for checking if the error found is available in the list of errors and then return the error if found, otherwise 'unknown'
     * @param string $error
     * @return string
     */
    private function error_returner(string $error): string
    {
        if($this->set_errors($error) === ''){
            $error = 'unknown';
        }

        return $error;
    }


    /**
     * returns the error from the set_error() method
     * @param string $error
     * @return string
     */
    public function get_error(string $error): string
    {
        return $this->set_errors($error);
    }


    public function get_category(): string
    {
        return $this->consigment['texts']['category'] ?? "News";
    }

    public function get_texts(): array
    {
        return $this->consigment['texts'];
    }


    /**
     * Magic methods
     */

     public function __get(string $name)
     {
        return match ($name) {
            'title_limit' => $_ENV['TITLE_COUNT'],
            'para_limit' => $_ENV['PARA_COUNT'],
            'uri' => $_SERVER['REQUEST_URI'],
            'default' => null
        };
     }
}