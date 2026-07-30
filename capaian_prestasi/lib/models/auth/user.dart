class User {
  final int id;
  final String name;
  final String email;
  final String? role;
  final List<dynamic>? roles;

  User({
    required this.id,
    required this.name,
    required this.email,
    this.role,
    this.roles,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: _toInt(json['id']),
      name: json['name']?.toString() ?? '',
      email: json['email']?.toString() ?? '',
      role: json['role']?.toString(),
      roles: json['roles'] is List ? json['roles'] : null,
    );
  }

  static int _toInt(dynamic value) {
    if (value is int) return value;
    if (value is double) return value.toInt();
    if (value is String) return int.tryParse(value) ?? 0;
    return 0;
  }
}
