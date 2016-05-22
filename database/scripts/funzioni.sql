-- Function: getastenutipercdc(integer, character varying)

-- DROP FUNCTION getastenutipercdc(integer, character varying);

CREATE OR REPLACE FUNCTION getastenutipercdc(ac_rif integer, ac_cdc character varying)
  RETURNS bigint AS
$BODY$select count(distinct ta001_soci.c_soc)
from ta001_soci
inner join ta003_cdc
on ta003_cdc.c_cdc = ta001_soci.c_cdc
where ta003_cdc.c_cdc = ac_cdc
and ta001_soci.c_soc not in (select c_soc from ts001_voti where ac_rif = 1)$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getastenutipercdc(integer, character varying)
  OWNER TO postgres;


-- Function: getvotantipercdc(integer, character varying)

-- DROP FUNCTION getvotantipercdc(integer, character varying);

CREATE OR REPLACE FUNCTION getvotantipercdc(ac_rif integer, ac_cdc character varying)
  RETURNS bigint AS
$BODY$select count(distinct ts001_voti.c_soc)
from ts001_voti
inner join ta001_soci
on ta001_soci.c_soc = ts001_voti.c_soc
inner join ta003_cdc
on ta003_cdc.c_cdc = ta001_soci.c_cdc
where ta003_cdc.c_cdc = ac_cdc
and ts001_voti.c_rif = ac_rif;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getvotantipercdc(integer, character varying)
  OWNER TO postgres;
