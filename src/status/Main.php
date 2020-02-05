<?php

namespace status;

use pocketmine\Server;

use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use onebone\economyapi\EconomyAPI;
use Saisana299\easyscoreboardapi\EasyScoreboardAPI;

use status\scoreTask\scoretask;

class Main extends PluginBase implements Listener{

	public function onEnable(){ 
		date_default_timezone_set('Asia/Tokyo');

        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getScheduler()->scheduleRepeatingTask(new scoretask($this), 5);

		$this->getLogger()->info("StatusScoreBoardを読み込みました。by  yutarou1241477");
		$this->api = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        if($this->api == null){
		$this->getLogger()->error("EconomyAPIが見つかりません。サーバーを停止します。");
		$this->getServer()->shutdown();
		}else{
		$this->getLogger()->info("EconomyAPIを確認しました。");
		}
		$this->api = $this->getServer()->getPluginManager()->getPlugin("EasyScoreboardAPI");
        if($this->api == null){
		$this->getLogger()->error("EasyScoreboardAPIが見つかりません。サーバーを停止します。");
		$this->getServer()->shutdown();
		}else{
		$this->getLogger()->info("EasyScoreboardAPIを確認しました。");
		}
    }
}


