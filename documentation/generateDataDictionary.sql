SELECT information_schema.tables.table_name,
	information_schema.columns.column_name,
	information_schema.columns.column_key,
	information_schema.columns.data_type,
	information_schema.columns.character_maximum_length,
	information_schema.columns.numeric_precision,
	information_schema.columns.numeric_scale,
	information_schema.columns.is_nullable,
	information_schema.columns.column_default,
	information_schema.columns.column_comment
FROM information_schema.tables
	INNER JOIN information_schema.columns ON information_schema.tables.table_name = information_schema.columns.table_name
WHERE information_schema.tables.table_schema = 'mediatheque';

