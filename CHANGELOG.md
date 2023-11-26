# Changes in DataCoder
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [2.0.0] - 2023-11-26
### Added
- Coder\Datafile\EncodingStrategyInterface - interface for data file encoders
- Coder\Datafile\DecodingStrategyInterface - interface for data file decoders

### Changed
- All namespaces
- Data Encoders implement interface Coder\Data\EncodingStrategyInterface
- Data Decoders implement interface Coder\Data\DecodingStrategyInterface

### Removed
- Additional not namespaced directory structure within src/ directory
- AbstractDataEncoder - base classes for data encoders
- AbstractDataDecoder - base classes for data decoders

## [1.0.0] - 2016-05-27
### Added
- DataEncoder - data encoder with configurable data format
- DataDecoder - data decoder with configurable data format
- DatafileEncoder - datafile encoder with configurable data format
- DatafileDecoder - datafile decoder with configurable data format
- JsonDataEncoder - data encoder for JSON data format
- JsonDataDecoder - data decoder for JSON data format
- JsonDatafileEncoder - datafile encoder for JSON data format
- JsonDatafileDecoder - datafile decoder for JSON data format
- YamlDataEncoder - data encoder for YAML data format
- YamlDataDecoder - data decoder for YAML data format
- YamlDatafileEncoder - datafile encoder for YAML data format
- YamlDatafileDecoder - datafile decoder for YAML data format
- DataFormat - enumerable data formats (JSON and YAML/YML)