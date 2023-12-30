<?php

namespace App\Controllers\ManagementControllers;
use App\Models\ArticlesModel;
use App\Validators\ParentValidator;


class ImageManagementController extends ParentValidator
{

    private array $images_consignment = [];
    private array $eligible_types = ['jpg', 'png', 'jpeg'];
    private string $uploadDirectory = 'images/Articles';

    private array $error_messages = [];

    // include the management trait for extra methods
    
    use ManagementTrait;

    public function __construct(
        private ArticlesModel $articlesModel
    )
    {
    }

    public function process_image(array $request,string $category): string
    {
        $sucess = $this->accept_request($request);

        if(! $sucess){
            throw new \Exception("Request can't be empty");
        }

        return $this->validateImages($request, $category);
    }

    private function validateImages(array $images, string $category): string
    {
        $error = '';

        // validate image_one: mandatory

        $image_one = $images['image_one'];

        if($image_one['name'] === ""){
            $error = 'one';
            return $this->error_returner($error);
        }


        if( $image_one['error'] > 0){
            $error = 'one_error';
            return $this->error_returner($error);
        }
        

        $image_one_type = explode("/", $image_one['type'])[1];

        if(! $this->arrayChecker($image_one_type, $this->eligible_types) ){
            $error = 'one_type';
            return $this->error_returner($error);;
        }

        if(! $this->sizeChecker($image_one['size'] / (1024 * 1024), $this->size) ){
            $error = "one_size";
            return $this->error_returner($error);;
        }

        if(! $this->upload_image($image_one['tmp_name'], $image_one_type, $category, "one")){
            $error = "one_upload";
            return $this->error_returner($error);;
        }


        // validate image_two: optional

        $image_two = $images['image_two'];

        if($image_two['name'] !== ""){
            return $this->validate_optional_images($image_two, 'two', $category);
        }

        
        // validate image_three: optional

        $image_three = $images['image_three'];

        if($image_three['name'] !== ""){
            return $this->validate_optional_images($image_three, 'three', $category);
        }

        // validate image_four: optional

        $image_four = $images['image_four'];

        if($image_four['name'] !== ""){
            return $this->validate_optional_images($image_four, 'four', $category);
        }

        // validate image_five: optional

        $image_five = $images['image_five'];

        if($image_five['name'] !== ""){
            return $this->validate_optional_images($image_five, 'five', $category);
        }

        return $this->error_returner($error);;
    }


    private function validate_optional_images(array $image, string $number, string $category): string
    {
        $error = "";

        if( $image['error'] > 0){
            $error = "{$number}_error";
            return $this->error_returner($error);;
        }

        $image_type = explode("/", $image['type'])[1];

        if(! $this->arrayChecker($image_type, $this->eligible_types) ){
            $error = "{$number}_type";
            return $this->error_returner($error);;
        }

        if(! $this->sizeChecker($image['size'] / (1024 * 1024), $this->size) ){
            $error = "{$number}_size";
            return $this->error_returner($error);;
        }

        if(! $this->upload_image($image['tmp_name'], $image_type, $category, $number)){
            $error = "{$number}_upload";
            return $this->error_returner($error);;
        }

        return $this->error_returner($error);;
    }


    private function upload_image(string $temp, string $type, string $category="News", string $number): bool
    {
        $name = 'article'.$this->articlesModel->randomIdCreator().'.'.$type;

        $this->uploadDirectory = match ($category){
            'News' => 'images/Articles/News',
            'Sports' => 'images/Articles/Sports',
            'Music' => 'images/Articles/Music',
            default => 'images/Articles/Lifestyle',
        };

        if(! move_uploaded_file($temp, $this->uploadDirectory."/".$name)){
            return false;
        }

        $this->images_consignment[] = ["image_{$number}" => $name];

        return true;
    }


    private function set_errors(string $error = ''): string
    {
        $this->error_messages = [
            'one' => "Image one can't be empty",
            'one_type' => "The format of image one is not eligible, use either jpg, png, or jpeg",
            'one_size' => "Image one size is larger than ".$this->size."MBs",
            'one_error' => "There was an unexpected error handling your image for paragraph one",
            'one_upload' => "Image one can't be uploaded, try again later",
            'two_type' => "The format of image two is not eligible, use either jpg, png, or jpeg",
            'two_size' => "Image two size is larger than ".$this->size."MBs",
            'two_error' => "There was an unexpected error handling your image for paragraph two",
            'two_upload' => "Image two can't be uploaded, try again later",
            'three_type' => "The format of image three is not eligible, use either jpg, png, or jpeg",
            'three_size' => "Image three size is larger than ".$this->size."MBs",
            'three_error' => "There was an unexpected error handling your image for paragraph three",
            'three_upload' => "Image three can't be uploaded, try again later",
            'four_type' => "The format of image four is not eligible, use either jpg, png, or jpeg",
            'four_size' => "Image four size is larger than ".$this->size."MBs",
            'four_error' => "There was an unexpected error handling your image for paragraph four",
            'four_upload' => "Image four can't be uploaded, try again later",
            'five_type' => "The format of image five is not eligible, use either jpg, png, or jpeg",
            'five_size' => "Image one size is larger than ".$this->size."MBs",
            'five_error' => "There was an unexpected error handling your image for paragraph five",
            'five_upload' => "Image five can't be uploaded, try again later",
            'upload' => "An error occurred uploading your images try again later",
            'unknown' => "An unknown error occurred uploading your images try again later",
        ];

        if(array_key_exists($error, $this->error_messages)){
            return $this->error_messages[$error];
        }

        return '';
    }


    private function error_returner(string $error): string
    {
        if($this->set_errors($error) === ''){
            $error = '';
        }

        return $error;
    }

    public function get_images(): array
    {
        return $this->images_consignment;
    }
    public function get_error(string $error): string
    {
        return $this->set_errors($error);
    }

    /**
     * Magic methods
     */

     public function __get(string $name): string|null
     {
        return match ($name) {
            'size' => $_ENV['IMAGE_SIZE'],
            default => null
        };
     }
}