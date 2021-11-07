<?php
namespace src;
abstract class Controller {
	const DIRECTORY_VIEW = ROOT . '/view';
	protected function View($file, array $params = [])
	{
		$twig = $this->makeTwig();
		echo $twig->render($file, $params);
	}

	protected function makeTwig()
	{
		$loader = new \Twig\Loader\FilesystemLoader(static::DIRECTORY_VIEW);
		return new \Twig\Environment($loader, ["debug" => true]);
	}
}