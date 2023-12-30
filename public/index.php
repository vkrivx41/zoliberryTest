
<link rel="shortcut icon" href="/images/logo/icon.png" type="image/x-icon">

<?php

    require_once __DIR__."/../vendor/autoload.php";

    ini_set("display_errors", 0);

    const VIEW_PATH = "./../Views";

    use App\{Router, Initiator, Container, Config};

    use App\Controllers\{
        Destroyer,
        PageNotFoundController,
        ManagerController,
        ManagementController, CreateNewController, ManagerRegistrationController,
        ManagerLoginController, ManagementControllers\PersonalInfoController,
        DashboardController, ManagementControllers\StatsController,
        ManagementControllers\ModeratorsController,
        ManagementControllers\AuthorsController,
        ManagementControllers\ArticlesManagementController,
        ArticleController, ModeratorArticlesController, ModeratorAuthorsController,
        ManagementControllers\EditArticleController, ManagementControllers\MessagesController
    };

    use App\Controllers\NavigationControllers\{
        HomeController, NewsController, MusicController,
        SportsController, LifestyleController
    };

    use App\Controllers\FooterControllers\{
        AboutUsController, PrivacyController, AdvertiseWithUsController,
        TermsController, DevelopersController, ContactUsController
    };

    use App\Controllers\UsersControllers\{
        ThemeController, UserDataController
    };


    // create the Dotenv Immutable class to load the env file from the parent directory

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));

    try {
        $dotenv->load();
    } catch (\Exception $error) {
        // catch-error for $_ENV
    }

    $container = new Container();
    
    $router = new Router($container);

    $router->registerRoutesFromControllerAttributes(
        [
                Destroyer::class,
            HomeController::class,
            NewsController::class,
            MusicController::class,
            SportsController::class,
            LifestyleController::class,
            ManagerController::class,
            ManagementController::class,
            CreateNewController::class,
            ManagerRegistrationController::class,
            ManagerLoginController::class,
            PersonalInfoController::class,
            DashboardController::class,
            AuthorsController::class,
            ModeratorsController::class,
            ArticlesManagementController::class,
            ArticleController::class,
            ModeratorArticlesController::class,
            ModeratorAuthorsController::class,
            AboutUsController::class,
            PrivacyController::class,
            AdvertiseWithUsController::class,
            TermsController::class,
            DevelopersController::class,
            ContactUsController::class,
            EditArticleController::class,
            MessagesController::class,
            ThemeController::class,
            UserDataController::class,
            StatsController::class,
            PageNotFoundController::class
        ]
    );

    $router->get('/Article', [ArticleController::class, 'index']);

    (new Initiator(
        $container,
        $router,
        [
            'method' => $_SERVER['REQUEST_METHOD'],
            'uri' => $_SERVER['REQUEST_URI']
        ],
        new Config($_ENV)
    ))->run();
