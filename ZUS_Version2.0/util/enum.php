<?php
	class Role {
		const __default = self::None;
		
		const None    = 0; // 游客
		const Invited = 1; // 邀请中
		const Pending = 2; // 申请中
		const Member  = 3; // 成员
		const Admin   = 4; // 管理员
		const Owner   = 5; // 创建人
		const Ghost   = -1;
		
		public static function get_const_array() {
			return array(
						 self::None    => '游客',
						 self::Invited => '邀请中',
						 self::Pending => '申请中',
						 self::Member  => '成员',
						 self::Admin   => '管理员',
						 self::Owner   => '创建人',
						 self::Ghost   => '不存在'
						 );
		}
		
		public static function get_role_icon() {
			return array(
						 self::None    => '',
						 self::Invited => '',
						 self::Pending => '',
						 self::Member  => '',
						 self::Admin   => '',
						 self::Owner   => '',
						 self::Ghost   => ''
						 );
		}
	}
	
	class EventCategory {
		const __default = self::All;
		
		const All  = 0;
		const a  = 1;
		const b = 2;
		const c = 3;
		const d = 4;
		const e = 5;
		const f = 99;

		public static function get_const_array() {
			return array(
						 self::All  => '全部',
						 self::a => '生活/聚会',
						 self::b => '出行/旅游',
						 self::c => '电影/演出',
						 self::d => '比赛/运动',
						 self::e => '教育/讲座',
						 self::f => '其他'
						 );
		}
	}

	class GroupCategory {
		const __default = self::All;
		
		const All  = 0;
		const a  = 1; // 官方
		const b = 2;
		const c = 3;
		const d = 4;
		const e = 5;
		const f = 99;
		
		public static function get_const_array() {
			return array(
						 self::All  => '全部',
						 self::b => '科技',
						 self::c => '人文',
						 self::d => '生活',
						 self::e => '娱乐',
						 self::f => '其他'
						 );
		}
	}

	class ArticleCategory {
		const __default = self::All;
		
		const All  = 0;
		const a  = 1; // 官方
		const b = 2;
		const c = 3;
		const d = 4;
		const e = 5;
		const f1 = 6;
		const f2 = 7;
		const f3 = 8;
		const g = 99;
		
		public static function get_const_array() {
			return array(
						 self::All  => '全部',
						 self::a => '科普',
						 self::b => '时尚',
						 self::c => '人文',
						 self::d => '吃喝玩乐',
						 self::e => '二手租房',
						 self::f1 => '闲言碎语',
						 self::f2 => '话题讨论',
						 self::f3 => '重口慎入',
						 self::g => '其他'
						 );
		}
	}
	
	class Privacy {
		const __default = self::All;
		
		const All   = 0;
		const Follower = 1;
		const Member   = 3;
		const Self     = 5;
		const NonExist = 99;
		
		public static function get_const_array() {
			return array(
						 self::All   => '公开',
						 self::Follower => '粉丝可见',
						 self::Member   => '成员可见',
						 self::Self     => '仅自己'
						 );
		}		
	}
	
	class Relation {
		const __default = self::None;

		const None          = 0;
		const Follower      = 1;
		const Following     = 2;
		const Friend        = 3;
		const Self          = 4;
		const Banned        = -1;

		public static function get_const_array() {
			return array(
						 self::None          => '无',
						 self::Follower      => '粉丝',   //p2 add p1
						 self::Following     => '关注中',  //p1 add p2
						 self::Friend        => '好友',
						 self::Self          => '我', 
						 self::Banned        => '黑名单'  // p1 banned p2
						 );
		}
	}

	class DefaultImage {
		const __default = '';
		
		const People = 'theme/images/default/default_people';
		const Event  = 'theme/images/default/default_group';
		const Group  = 'theme/images/default/default_group';
		const Photo  = 'theme/images/default/default_group';
		const QR     = 'theme/images/default/default_qr.png';
		const ErrPg  = 'theme/images/default/default_error.jpg';
	}
	
	class RepeatTimeSpan {
		const __default = self::None;

		const None   = 0;
		const Day    = 1;
		const Week   = 2;
		const Month  = 3;
		const Season = 4;
		const Year   = 5;
		
	}
	
	class oyster_Gender 
	{
		const __default = self::Unknown;

		const Female   = 0;
		const Male     = 1;
		const Unknown  = 2;
		const WomanMan = 3;
		const ManWoman = 4;
		const LORI     = 5;
		const TeenBoy  = 6;
		const Meow     = 7;
		const Wong     = 8;
		const Animal   = 9;
		const Altman   = 10;
		const Monster  = 11;
		const Robot    = 12;
		const Zombie   = 13;
		const Ghost    = 14;
		const Bug      = 15;
		const Other    = 99;
		const All 	   = 100;
		
		public static function get_const_array() 
		{
			return array(
						 self::Female   => '女',
						 self::Male     => '男',
						 self::Unknown  => '未知',
						 self::WomanMan => '女汉子',
						 self::ManWoman => '伪娘',
						 self::LORI     => '萝莉',
						 self::TeenBoy  => '正太',
						 self::Meow     => '喵星人',
						 self::Wong     => '汪星人',
						 self::Animal   => '小萌物',
						 self::Altman   => '凹凸曼',
						 self::Monster  => '小怪兽',
						 self::Robot    => '机器人',
						 self::Zombie   => '僵尸',
						 self::Ghost    => '幽灵',
						 self::Bug      => '小强',
						 self::Other    => '其它',
						 self::All      => '全部'
			);
		}
	}

	class Gender 
	{
		const __default = self::Unknown;

		const Female   = 0;
		const Male     = 1;
		
		public static function get_const_array() 
		{
			return array(
						 self::Female   => '女',
						 self::Male     => '男'
			);
		}
	}
	?>
