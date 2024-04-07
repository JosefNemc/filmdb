<?php

declare(strict_types=1);
namespace App\Presenters;

use App\Model\Movies;


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
        $this->token = '1234'; // Token pro autorizaci
    }


    public function actionDefault(int $id = null) //bez parametru vrátí seznam všech filmů
    {

        if ($this->getHttpRequest()->getHeader('Authorization') !== $this->token)
        {
                //Autorizace v pořádku máme GET
                if ($this->getHttpRequest()->isMethod('GET') && $id === null) {
                    $movies = $this->movies->fetchAll();
                    foreach ($movies as $movie)
                    {
                        $moviesData[] = [
                            'id' => $movie->id,
                            'name' => $movie->name,
                            'author' => $movie->author,
                            'description' => $movie->description
                        ];
                    }

                    $this->sendJson($moviesData);
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


                    $this->sendJson($moviesData);
                }

            if ($this->getHttpRequest()->isMethod('POST') && $id === null) {
                $requestData = $this->getHttpRequest()->getPost(); // Získání dat z požadavku
                if (isset($requestData['name']) && isset($requestData['author']) && isset($requestData['description']))
                    {
                       $this->movies->create($requestData);
                       $this->sendJson(['success' => true]);
                    }
                else
                    {

                       $this->sendJson(['error' => 'Missing data']);
                    }

            }
            elseif($this->getHttpRequest()->isMethod('PUT') && $id !== null)
            {
                $requestData = $this->getHttpRequest()->getPost(); // Získání dat z POST požadavku
                if (isset($requestData['name']) && isset($requestData['author']) && isset($requestData['description']) && ($id !== null))
                    {
                        $this->movies->update($id,$requestData);
                        $this->sendJson(['success' => true]);
                    }
                else
                    {
                       $this->sendJson(['error' => 'Missing data']);
                    }
                }
            elseif($this->getHttpRequest()->isMethod('DELETE') && $id !== null)
            {
                $this->movies->delete($id);
                $this->sendJson(['success' => true]);
            }

        }

        else
        {

            $this->getHttpResponse()->setCode(401);
            $this->sendJson(['error' => 'Unauthorized']);
        }

    }
}