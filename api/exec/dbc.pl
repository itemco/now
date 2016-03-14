#!/usr/bin/perl

use strict;
use warnings;
use 5.010;
use Getopt::Long qw(GetOptions);
use Data::Dumper;
 
#my $debug;
#my $source_address = 'Maven';
#GetOptions(
#    'from=s' => \$source_address,
#    'debug' => \$debug,
#) or die "Usage: $0 --debug  --from NAME\n";
 
#say $debug ? 'debug' : 'no debug';
#if ($source_address) {
#    say $source_address;
#}
#print Dumper \@ARGV;

#if (!$ARGV[0]) {
#  print "ERROR|PROPERTIES-FILE parameter not specified\n";
#  exit;
#}
#if (!$ARGV[1]) {
#  print "ERROR|TABLE parameter not specified\n";
#  exit;
#}
#if (!$ARGV[2]) {
#  print "ERROR|WHERE parameter not specified\n";
#  exit;
#}

my $file = "$ARGV[0]";
my $table = "$ARGV[1]";
my $where = "$ARGV[2]";

#behaves different when using ssh, checking params again...
if ($file =~ "--") {
  print "ERROR|PROPERTIES-FILE parameter not specified\n";
  exit;
}
if ($table =~ "--") {
  print "ERROR|TABLE parameter not specified\n";
  exit;
}
if ($where =~ "--") {
  print "ERROR|WHERE parameter not specified\n";
  exit;
}

#print "@ARGV[0]\n";
#print "file: $file\n";
#print "table: $table\n";
#print "where: $where\n";

#use $file above to pick values from db.properties-file

my $db_host = "N/A";
my $db_name = "N/A";
my $db_user = "N/A";
my $db_pass = "N/A";

#print "Reding $file to pick db-stuff...\n";

use strict;
use warnings;
 
open(my $fh, '<:encoding(UTF-8)', $file)
  or die "Could not open file '$file' $!";
 
while (my $row = <$fh>) {
  chomp $row;
  #print "$row\n";
  if ($row =~ /datasource.jdbc/) {
    #print "jdbc match!\n";
    $row =~ s/\Q:3306\E//g;
    #print "$row\n";
    my @parts1 = split /\//, $row;
    #print Dumper \@parts1;
    $db_host = $parts1[2];
    my @parts2 = split /\?/, $parts1[3];
    #print Dumper \@parts2;
    $db_name = $parts2[0];
  }
  if ($row =~ /datasource.user/) {
    my @parts3 = split /=/, $row;
    $db_user = $parts3[1];
  }
  if ($row =~ /datasource.password/) {
    my @parts4 = split /=/, $row;
    $db_pass = $parts4[1];
  }
}

#print "------------\n";
#print "$db_host\n";
#print "$db_name\n";
#print "$db_user\n";
#print "$db_pass\n";
#print "------------\n";

use DBI;
my $dbh = DBI->connect("DBI:mysql:database=$db_name;host=$db_host", "$db_user", "$db_pass", {'RaiseError' => 1});
my $sql = "SELECT COUNT(*) FROM $table WHERE $where";
#print "$sql\n";
my $sth = $dbh->prepare($sql);

$sth->execute();
print "$sql\n";
#while (my $ref = $sth->fetchrow_hashref()) {
while (my @row = $sth->fetchrow_array) {
  #print "$ref->{'count'}\n";
  print "$row[0]\n";
}
$sth->finish();
$dbh->disconnect();

