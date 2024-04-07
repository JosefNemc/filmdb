<?php

declare(strict_types=1);
namespace App\Presenters\Api\v1;

use App\Model\Movies;

use Nette\Application\Responses\JsonResponse;
use Nette\Application\UI\Presenter;

class MoviesPresenter extends Presenter
{
    private Movies $movies;


    public function __construct(Movies $movies)
    {
        parent::__construct();
        $this->movies = $movies;

    }

    public function startup()
    {
        parent::startup();
        bdump($this->httpRequest->getRawBody());
        if ($this->httpRequest->getMethod() === 'POST') {
            $this->sendJson(['success' => true]);
        }
    }


    public function actionDefault() //bez parametru vrátí seznam všech filmů
    {
      $movies = $this->movies->fetchAll();
      $this->sendJson($movies);
    }

    // Metoda pro získání detailu konkrétního filmu
    public function actionDetail($id)
    {
        // Zde získáte detail filmu s daným ID (např. z databáze)
        $movie = ['id' => $id, 'title' => 'Film ' . $id];

        // Odpověď ve formátu JSON
        $this->sendJson($movie);
    }

    // Metoda pro vytvoření nového filmu
    public function actionCreate()
    {
        // Zpracování POST požadavku pro vytvoření nového filmu
        $requestData = $this->getHttpRequest()->getPost(); // Získání dat z POST požadavku
        // Validace a uložení nového filmu (např. do databáze)

        // Odpověď ve formátu JSON
        $this->sendJson(['success' => true]);
    }

    // Metoda pro editaci filmu
    public function actionUpdate($id)
    {
        // Zpracování PUT požadavku pro aktualizaci existujícího filmu s daným ID
        $requestData = json_decode($this->getHttpRequest()->getRawBody(), true); // Získání dat z těla PUT požadavku
        // Validace a aktualizace dat filmu (např. v databáze)

        // Odpověď ve formátu JSON
        $this->sendJson(['success' => true]);
    }

    // Metoda pro smazání filmu
    public function actionDelete($id)
    {
        // Zpracování DELETE požadavku pro smazání filmu s daným ID
        // Validace a smazání dat filmu (např. v databáze)

        // Odpověď ve formátu JSON
        $this->sendJson(['success' => true]);
    }
}