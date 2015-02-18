use EPLKitManagement

create table Branches
(
	ID int identity(100000, 1) primary key,
	BranchManagerID int,
	BranchID nvarchar,
	Name nvarchar,
	EPLAddress nvarchar,
	Phone nvarchar,
	Latitude float,
	Longitude float
)

create table KitTypes
(
	ID int identity(100000, 1) primary key
	Name nvarchar
)

create table Kits
(
	ID int identity(100000, 1) primary key
	Name nvarchar,
	AtBranch int,
	Available bit,
	KitState int,
	KitDesc nvarchar,
	Specialized bit,
	SpecializedName nvarchar
)

create table KitContents
(
	ID int identity(100000, 1) primary key,
	KitID int,
	Name nvarchar,
	SerialNumber nvarchar,
	Damaged bit,
	Missing bit
)

create table KitState
(
	ID int identity(100000, 1) primary key,
	StateName nvarchar
)

create table Booking
(
	ID int identity(100000, 1) primary key,
	KitID int,
	ForBranch int,
	StartDate datetime,
	EndDate datetime,
	ShadowStartDate datetime,
	ShadowEndDate datetime,
	Purpose nvarchar
)
/* may need booking archive table */

create table BookingDetails
(
	ID int identity(100000, 1) primary key,
	BookingID int,
	UserID int,
	Email nvarchar,
	Booker bit
)

create table users
(
	id int,
	username text,
	password text,
	realname text,
	remember_token varchar,
	updated_at datetime,
	created_at text
)

create table Logs
(
	ID int identity(100000, 1) primary key,
	LogDate datetime,
	LogType int,		/* determines user or kit */
	LogKey1 int,		/* kit id  */
	LogKey2 int,		/* part id */
	LogUserID int,
	LogMessage text
)

create table LogType
(
	ID int identity(100000, 1) primary key,
	Name text
)