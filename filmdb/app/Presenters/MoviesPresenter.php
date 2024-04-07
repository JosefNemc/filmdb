<?php

declare(strict_types=1);
namespace App\Presenters;

use App\Model\Movies;

use Nette\Application\Responses\JsonResponse;
use Nette\Application\UI\Presenter;

class MoviesPresenter extends Presenter
{
    private Movies $movies;
    private string $token;


    public function __construct(Movies $movies)
    {
        parent::__construct();
        $this->movies = $movies;

    }

    public function startup()
    {
        parent::startup();
        $this->token = '1234';
    }


    public function actionDefault(int $id = null) //bez parametru vrátí seznam všech filmů
    {
        bdump($this->getHttpRequest());


        //seznam všech filmů
        if ($this->getHttpRequest()->getHeader('Authorization') !== $this->token) {
                //Autorizace v pořádku máme GET
                if ($this->getHttpRequest()->isMethod('GET') && $id === null) {
                    $movies = $this->movies->fetchAll();
                    foreach ($movies as $movie) {
                        $moviesData[] = [
                            'id' => $movie->id,
                            'name' => $movie->name,
                            'author' => $movie->author,
                            'description' => $movie->description
                        ];
                    }
                    dump($moviesData,'Seznam filmů jen GET bez ID');
                    // $this->sendJson($response);
                }
                else
                {
                    $movies = $this->movies->fetch($id);

                        $moviesData[] = [
                            'id' => $movies->id,
                            'name' => $movies->name,
                            'author' => $movies->author,
                            'description' => $movies->description
                        ];

                    dump($moviesData,'Jeden film ');
                    // $this->sendJson($response);
                }

            if ($this->getHttpRequest()->isMethod('POST') && $id === null) {
                $requestData = $this->getHttpRequest()->getPost(); // Získání dat z požadavku
                if (isset($requestData['name']) && isset($requestData['author']) && isset($requestData['description'])) {
                    $this->movies->create($requestData);
                   dump($requestData,'vložení filmu - true');
                    //$this->sendJson(['success' => true]);
                }
                else
                {
                    dump('Missing data','vložení filmu - false');
                   // $this->sendJson(['error' => 'Missing data']);
                }

            }
            elseif($this->getHttpRequest()->isMethod('PUT') && $id !== null)
            {
                $requestData = $this->getHttpRequest()->getPost(); // Získání dat z POST požadavku
                if (isset($requestData['name']) && isset($requestData['author']) && isset($requestData['description']) && ($id !== null)) {
                    $this->movies->update($id,$requestData);
                    dump($requestData,'aktualizace filmu - true');
                    //$this->sendJson(['success' => true]);
                }
                else
                {
                    dump('Missing data','aktualizace filmu - false');
                    // $this->sendJson(['error' => 'Missing data']);
                }
            }
            elseif($this->getHttpRequest()->isMethod('DELETE') && $id !== null)
            {
                $this->movies->delete($id);
                dump('Smazání filmu - true');
                // $this->sendJson(['success' => true]);
            }

        }

        else
        {
            dump('Unauthorized');
            // $this->getHttpResponse()->setCode(401);
            // $this->sendJson(['error' => 'Unauthorized']);
        }

    }
}