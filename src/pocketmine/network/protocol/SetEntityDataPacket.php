<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>

#ifndef COMPILE
use pocketmine\utils\Binary;

#endif

class SetEntityDataPacket extends PEPacket{
	const NETWORK_ID = Info::SET_ENTITY_DATA_PACKET;
	const PACKET_NAME = "SET_ENTITY_DATA_PACKET";

	public $eid;
	public $metadata;

	public function decode($playerProtocol){

	}

	public function encode($playerProtocol){
		$this->reset($playerProtocol);
		$this->putEntityRuntimeId($this->eid);
		$meta = Binary::writeMetadata($this->metadata, $playerProtocol);
		$this->put($meta);
		if($playerProtocol >= Info::PROTOCOL_557){
			$this->putVarInt(0); //int property sync data count
			$this->putVarInt(0); //float property sync data count
		}
		if($playerProtocol >= Info::PROTOCOL_419){
			$this->putVarInt(0); // which tick from PlayerAuthInputPacket its on //unsigned varint64
		}
	}

}
