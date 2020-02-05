<?php

namespace status\Task;

use pocketmine\Server;

use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\scheduler\Task;

use onebone\economyapi\EconomyAPI;
use Saisana299\easyscoreboardapi\EasyScoreboardAPI;

use status\Main;

class scoreTask extends Task{

	public function onRun(int $tick){
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			$x = floor($player->getX());
			$y = floor($player->getY());
			$z = floor($player->getZ());                       
			$name = $player->getName();
			$money = EconomyAPI::getInstance()->myMoney($name);
			$p = count($player->getServer()->getOnlinePlayers());
			$full = $player->getServer()->getMaxPlayers();
			$item = $player->getInventory()->getItemInHand();
			$id = $item->getId();
			$meta = $item->getDamage();
			$itemname = $item->getName();
			$time = date("G時i分s秒");
			$ping = $player->getPing();
			$worldn = $player->getLevel()->getName();
			switch ($player->getDirection()){
				case 0:
					$dire = "東";
					break;
				case 1:
					$dire = "北";
					break;
				case 2:
					$dire = "西";
					break;
				case 3:
					$dire = "南";
					break;
			}
			$api = EasyScoreboardAPI::getInstance(); 
			$api->sendScoreBoard($player, "sidebar", "§lユーザーステータス§r", false); 
			$api->setScore($player, "sidebar", "§a名前 §f: {$name}", 0 , 0);
			$api->setScore($player, "sidebar", "§6現在時刻 §f: {$time}", 1 , 1);
			$api->setScore($player, "sidebar", "§d所持金 §f: {$money}", 2 ,2);
			$api->setScore($player, "sidebar", "§5アイテム名 §f: {$itemname}", 3,3);
			$api->setScore($player, "sidebar", "§4アイテムID §f: {$id} : {$meta}", 4, 4);
			$api->setScore($player, "sidebar", "§bサーバー人数 : §f{$p}/{$full}", 5, 5);
			$api->setScore($player, "sidebar", "§aPing値 : {$ping}", 6, 6);
			$api->setScore($player, "sidebar", "§e方角 : X:{$x}/Y:{$y}/Z:{$z}", 7, 7);
			$api->setScore($player, "sidebar", "§e方位 : {$dire}", 8, 8);
			$api->setScore($player, "sidebar", "§eワールド名 : {$worldn}", 9, 9);
		}
	}
}

